<?php
Use Lidiun\Render;
Use Lidiun\Request;

Class send_message 
{
  function __construct() {
	$parameter = Request::getParameter();
	if ($parameter && is_array($parameter)) {
	    $reply = ['reply' => true, 'message' => $parameter['message']];
	} else {
		$reply = ['reply' => false, 'message' => 'Message is required'];
	}

	Render::setReply($reply);
  } 
}