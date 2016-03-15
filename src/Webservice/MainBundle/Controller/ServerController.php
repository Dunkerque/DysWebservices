<?php

namespace Webservice\MainBundle\Controller;

use JsonRpc\Server;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webservice\MainBundle\Libs\ServerTransport;

/**
 * see http://www.jsonrpc.org/specification
 *
 */
class ServerController extends Controller {

    const PARSE_ERROR = -32700;
    const SERVER_ERROR = -32000;
    const INVALID_REQUEST = -32600;
    const METHOD_NOT_FOUND = -32601;
    const INVALID_PARAMS = -32602;
    const INTERNAL_ERROR = -32603;
    const INVALID_API_KEY = 401;

    /**
     * Analyse la requête et lance la méthode définie avec ses paramètres.
     * Le nom de la classe où se trouve la méthode doit être fournie dans l'url après le préfixe.
     * La clef d'accès doit être présente dans le config.yml
     *
     * @param Request   $httprequest    Requête http
     * @param String    $nomClasse     Nom de la classe
     * @param String    $apiKey        Clef d'accès à l'api
     *
     * @return Response
     */
    public function jsonrpcAction(Request $httprequest, $nomClasse, $apiKey) {

        $apiMapper = $this->getParameter('service_mapper');

        $result = $this->getParameter('api_key');

        // Si clef d'accès non présente dans la table des clefs...
        if ($result != $apiKey) {
            return $this->getErrorResponse(self::INVALID_API_KEY, null);
        }
        // Transport classe spécial pour avoir le retour dans la réponse et pas dans le stdout
        /* @var $transport \Webservice\MainBundle\Libs\ServerTransport */
        $transport = new ServerTransport();
        // Capture une instance de la classe du service
        $server = new Server($this->get($apiMapper.".".$nomClasse), $transport);
        // Convertir les objets JSON en array associatives
        $server->setObjectsAsArrays();
        // Traitement de la requête, réponse dans objet $transport
        $server->receive($httprequest->getContent());

        return $transport->response;
    }

    protected function getErrorResponse($code, $id, $data = null) {
        $response = array('jsonrpc' => '2.0');
        $response['error'] = $this->getError($code);
        if ($data != null) {
            $response['error']['data'] = $data;
        }
        $response['id'] = $id;
        return new Response(json_encode($response), 200, array('Content-Type' => 'application/json'));
    }

    protected function getError($code) {
        $message = '';
        switch ($code) {
            ## ERREUR JSONRPC 2.0
            case self::PARSE_ERROR:
                $message = 'Parse error';
                break;
            case self::INVALID_REQUEST:
                $message = 'Invalid request';
                break;
            case self::METHOD_NOT_FOUND:
                $message = 'Method not found';
                break;
            case self::INVALID_PARAMS:
                $message = 'Invalid params';
                break;
            case self::INTERNAL_ERROR:
                $message = 'Internal error';
                break;
            case self::INVALID_API_KEY:
                $message = 'Invalid api key';
                break;
        }
        return array('code' => $code, 'message' => $message);
    }

}
