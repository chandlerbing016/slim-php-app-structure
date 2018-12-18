<?php

namespace Kirk\Controllers;

use Kirk\Lib\Tools;

class UserController extends \Kirk\Core\Controller
{
    public function showallposts($request, $response)
    {
        $data = array();
        $user = $request->getAttribute('logged_in_user');
        $data['lgd_user'] = is_null($user) ? [] : $user;

        $post_repo = $this->repo_post();
        if (!$post_repo) {
            throw new \Exception('Invalid Repository.');
        }

        if(!isset($user['user-id'])) {
            throw new \Exception('Invalid entrance. Check routes. Or dump on $user var in case of changed index key names');
        }

        $user_id = Tools::rotate_id((int)$user['user-id']);

        $data['posts'] = $post_repo->getAllPostsByUserId((int)$user_id);

        return $this->view->render($response, 'allposts.twig', $data);
    }
}
