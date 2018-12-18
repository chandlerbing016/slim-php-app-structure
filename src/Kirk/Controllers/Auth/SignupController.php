<?php

namespace Kirk\Controllers\Auth;

use Kirk\Entities\User;
use Kirk\Lib\Session;
use Kirk\Lib\Tools;

class SignupController extends \Kirk\Core\Controller
{
    public function login($request, $response)
    {
        $errors = array();
        if ($request->isPost()) {
            $parsedBody = $request->getParsedBody();
            $userName = $parsedBody['display-name'];
            $userPassword = $parsedBody['password'];

            // TODO: apply validation
            /**
             * $validate = Tools::validate($parsedBody, array(
             *      'display-name' => ['string']
             *      'email' => ['string', 'email']
             * ));
             */
            $validate = true;
            if ($validate) {
                $userRepo = $this->repo_user();
                if ($userRepo == false) {
                    throw new \Exception("Invalid Repository");
                }
                $user = $userRepo->getUserByUsername($userName);

                if(isset($user['displayname'])) {
                    
                    Session::set('logged_in_user', array(
                        'displayname' => $user['displayname'],
                        'logged-in' => '1',
                        'user-id' => Tools::rotate_id((int)$user['id'])
                    ));

                    return $response->withRedirect('/', 301);
                }
            }

            $errors[] = "Validation failed or incorrect password or could not find user.";
        }
        return $this->view->render($response, 'auth/signup.twig', ['errors' => $errors]);
    }

    public function logout($request, $response)
    {
        Session::destroy('logged_in_user');
        return $response->withRedirect('/g/login', 301);
    }

    public function signup($request, $response)
    {
        $parsedBody = $request->getParsedBody();

        $user = new User();

        $user->setDisplayname($parsedBody['display-name']);
        $user->setEmail($parsedBody['email']);
        $user->setJoiningDate();

        $this->em->persist($user);
        $this->em->flush();

        return $response->withRedirect('/', 301);
    }
}
