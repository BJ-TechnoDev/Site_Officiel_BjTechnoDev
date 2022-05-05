<?php

namespace App\Controller\Admin;

use App\Entity\Projet;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProjetCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Projet::class;
    }

    public function configureFields(string $pageName): iterable
    {

        yield TextField::new('titre')
            ->setLabel('Titre (Maximum 20 caractères)');
        yield TextField::new('link')
            ->setLabel('Link du site');
        if ($pageName === Crud::PAGE_NEW){
            yield ImageField::new('img_bg', 'Image Background')
                ->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
                ->setUploadDir('public/uploads/img_bg')
                ->setBasePath('uploads/img_bg')
                ->setRequired(true);
        }else{
            yield ImageField::new('img_bg', 'Image Background')
                ->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
                ->setUploadDir('public/uploads/img_bg')
                ->setBasePath('uploads/img_bg');
        }
        if ($pageName === CRUD::PAGE_NEW) {
            yield ImageField::new('img_rond', 'Image Front')
                ->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
                ->setUploadDir('public/uploads/img_rond')
                ->setBasePath('uploads/img_rond')
                ->setRequired(true);
        }else{
            yield ImageField::new('img_rond', 'Image Front')
                ->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
                ->setUploadDir('public/uploads/img_rond')
                ->setBasePath('uploads/img_rond');
        }

    }


    /**
     * @param AdminContext $context
     * @param string $action
     * @return RedirectResponse
     */
    protected function getRedirectResponseAfterSave(AdminContext $context, string $action): RedirectResponse
    {
        /**
         * @var $entityInstance Projets
         */
        $entityInstance = $context->getEntity()->getInstance();

        $image = $entityInstance->getImgRond();
        $imagebg = $entityInstance->getImgBg();
        if (!isset($image, $imagebg)){
            $adminurlgenerator = $this->get(AdminUrlGenerator::class);
            $this->addFlash('warning', 'merci de mettre une image');
            return $this->redirect($adminurlgenerator->setController(ProjetCrudController::class)->setAction('edit')->setEntityId($entityInstance->getId())->generateUrl());
        }
        return parent::getRedirectResponseAfterSave($context, $action);
    }
}