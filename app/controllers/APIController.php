<?php

use Illuminate\Routing\Controller;
use Dingo\Api\Routing\ControllerTrait;

class APIController extends Controller {
    use ControllerTrait;
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function login() {
        $user=User::find(1);
        Log::info('received');
        return $this->response->array($user->toArray());
//        return Input::get('pass');
    }


}
