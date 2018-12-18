<?php

namespace Kirk\Controllers;

use Kirk\Repositories\UserRepository;
use Kirk\Entities\Post;
use Doctrine\ORM\Query;

class HomeController extends \Kirk\Core\Controller
{
    public function index($request, $response)
    {
        $data = array();
        $user = $request->getAttribute('logged_in_user');
        $data['lgd_user'] = is_null($user) ? [] : $user;

        $post_repo = $this->repo_post();

        $data['recent_posts'] = $post_repo->getRecentPosts();

        return $this->view->render($response, 'home.twig', $data);
    }
}
