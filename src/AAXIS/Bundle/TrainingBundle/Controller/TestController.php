<?php

namespace AAXIS\Bundle\TrainingBundle\Controller;

use AAXIS\Bundle\TrainingBundle\Entity\Test;
use AAXIS\Bundle\TrainingBundle\Form\Type\TestType;
use Oro\Bundle\FormBundle\Model\UpdateHandlerFacade;
use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Contains CRUD actions for Test
 *
 * @Route("/test", name="aaxis_training_test_")
 */
class TestController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @Template
     * @AclAncestor("aaxis_training_test_view")
     */
    public function indexAction(): array
    {
        return [
            'entity_class' => Test::class
        ];
    }

    /**
     * @Route("/view/{id}", name="view", requirements={"id"="\d+"})
     * @Template
     * @Acl(
     *      id="aaxis_training_test_view",
     *      type="entity",
     *      class="AAXIS\Bundle\TrainingBundle\Entity\Test",
     *      permission="VIEW"
     * )
     */
    public function viewAction(Test $entity): array
    {
        return [
            'entity' => $entity,
        ];
    }

    /**
     * Create Test
     *
     * @Route("/create", name="create", options={"expose"=true})
     * @Template("@AAXISTraining/Test/update.html.twig")
     * @Acl(
     *      id="aaxis_training_test_create",
     *      type="entity",
     *      class="AAXIS\Bundle\TrainingBundle\Entity\Test",
     *      permission="CREATE"
     * )
     */
    public function createAction(Request $request): array|RedirectResponse
    {
        $createMessage = $this->get(TranslatorInterface::class)->trans(
            'aaxis.training.controller.test.saved.message'
        );

        return $this->update(new Test(), $request, $createMessage);
    }

    /**
     * Edit Test form
     *
     * @Route("/update/{id}", name="update", requirements={"id"="\d+"})
     * @Template
     * @Acl(
     *      id="aaxis_training_test_update",
     *      type="entity",
     *      class="AAXIS\Bundle\TrainingBundle\Entity\Test",
     *      permission="EDIT"
     * )
     */
    public function updateAction(Test $entity, Request $request): array|RedirectResponse
    {
        $updateMessage = $this->get(TranslatorInterface::class)->trans(
            'aaxis.training.controller.test.saved.message'
        );

        return $this->update($entity, $request, $updateMessage);
    }

    protected function update(
        Test $entity,
        Request $request,
        string $message = ''
    ): array|RedirectResponse {
        return $this->get(UpdateHandlerFacade::class)->update(
            $entity,
            $this->createForm(TestType::class, $entity),
            $message,
            $request,
            null
        );
    }

    public static function getSubscribedServices(): array
    {
        return array_merge(
            parent::getSubscribedServices(),
            [
                TranslatorInterface::class,
                UpdateHandlerFacade::class,
            ]
        );
    }
}
