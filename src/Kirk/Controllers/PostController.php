<?php

namespace Kirk\Controllers;

use Kirk\Entities\User;
use Kirk\Entities\Post;
use Kirk\Entities\Tag;

class PostController extends \Kirk\Core\Controller
{
    public function index($request, $response)
    {
        return $this->view->render($response, 'newpost.twig');
    }

    public function viewone($request, $response, $postId)
    {
        $postRepo = $this->repo_post();

        $post = $postRepo->getPostById($postId['id']);

        return $this->view->render($response, 'singlepost.twig',
            ['post' => isset($post[0]) ? $post[0] : []]
        );
    }

    public function editone($request, $response, $postId)
    {
        #assume that it passed the middleware and logged in user is 1
        $postRepo = $this->repo_post();
        
        #assume that it already exists in the database
        $post = $postRepo->getPostById($postId['id']);

        return $this->view->render($response, 'editpost.twig',
            ['post' => isset($post[0]) ? $post[0] : []]
        );
    }

    public function editsave($request, $response)
    {
        $parsedBody = $request->getParsedBody();

        if(!isset($parsedBody['post-id'])) {
            $error = 'invalid post';
        }

        try {
            $post = $this->em->find(Post::class, (int)$parsedBody['post-id']);
            $post->setTitle($parsedBody['title']);
            $post->setContent($parsedBody['content']);
            $post->setLastUpdatedDate();

            $this->em->flush();

            $url = $this->container->get('router')
                ->pathFor('view.view.post', ['id' => (int)$parsedBody['post-id']]);

            return $response->withRedirect($url, 301);
            
        } catch(Exception $e) {
            throw new \Exception("Failed to update <br>" . $e);
        }
    }

    public function new($request, $response)
    {
        $parsedBody = $request->getParsedBody();

        # assume logged-in userid is 1
        $user = $this->em->find(User::class, 1);

        # all tags
        $tag_1 = $this->em->find(Tag::class, 1);
        $tag_2 = $this->em->find(Tag::class, 2);

        $post = new Post();
        $post->setTitle($parsedBody['title']);
        $post->setContent($parsedBody['content']);

        $post->setUser($user);

        $post->setTag($tag_1);
        $post->setTag($tag_2);

        $this->em->persist($post);
        $this->em->flush();

        return $response->withRedirect('/', 301);
    }
}
