<?php

namespace Webservice\MainBundle\Libs;

use Symfony\Component\HttpFoundation\Response;

/**
 * Classe Transport personnalisé pour le serveur jsonrpc
 *
 * @author Danny Pacheco
 */
class ServerTransport {

  /** @var \Symfony\Component\HttpFoundation\Response */

  public $response;

  public function __construct() {
      
      $this->response = null;
  }

  /**
   * Capture entrée standard (requête brute)
   *
   * @return String
   */
  public function receive()
  {
        // do something to get the received data
        $data = @file_get_contents('php://input');
        return $data;
  }

  /**
   * Formatte la réponse en objet réponse http symfony2
   *
   * @param String $data
   */
  public function reply($data)
  {
        // Set sf2 response
        $this->response= new Response($data, 200, array('Content-Type' => 'application/json'));
  }

}

?>
