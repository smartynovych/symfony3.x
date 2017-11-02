<?php

namespace AppBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use AppBundle\Entity\Article;

class IpTraceSubscriber implements EventSubscriber
{
    protected $twig;
    protected $mailer;

    public function __construct(\Twig_Environment $twig, \Swift_Mailer $mailer)
    {
        $this->twig = $twig;
        $this->mailer = $mailer;
    }

    public function getSubscribedEvents()
    {
        return array(
            'postPersist',
            'postUpdate',
        );
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->index($args);
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $this->index($args);
    }

    public function index(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof Article) {
            $message = \Swift_Message::newInstance()
                ->setSubject('Article ' . $entity->getId() . ' updated')
                ->setFrom('noreply@example.com')
                ->setTo('dev@example.com')
                ->setBody(
                    $this->twig->render(
                        'mail/article.html.twig',
                        array('name' => $entity->getName())
                    ),
                    'text/html'
                )
                ->addPart(
                    $this->twig->render(
                        'mail/article.txt.twig',
                        array('name' => $entity->getName())
                    ),
                    'text/plain'
                )
            ;
            $this->mailer->send($message);

            // Тут добавляем код для выполнения реакции на событие
            //$entityManager = $args->getEntityManager();
            //$article = $entityManager->getRepository(Article::class)->find(1);
        }
    }
}
