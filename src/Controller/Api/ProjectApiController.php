<?php


namespace App\Controller\Api;


use App\Entity\Project;
use App\Repository\LocaleRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProjectApiController extends AbstractController
{

    public function get_project(Project $project, LocaleRepository $localeRepository, ProjectRepository $projectRepository)
    {
        /** @var Project $project */
        $project = $projectRepository->getProjectById($project->getId())[0];
        $locales = $localeRepository->getAllShortNames();
        foreach ($locales as $key =>$locale) {
            $locales[$key] = $locale['short_name'];
        }
        $result = ['id' => $project->getId(), 'slug' => $project->getSlug(), 'icon' => $project->getImage()];
        foreach ($project->getProjectTranslations() as $projectTranslation) {
            $result['translations'][$projectTranslation->getLocale()->getShortName()] = ['name' => $projectTranslation->getName(), 'description' => $projectTranslation->getDescription()];
        }


        foreach ($locales as $item) {
            if (!isset($result['translations'][$item]) && isset($result['translations']['ru']))
                $result['translations'][$item] = $result['translations']['ru'];
        }


        return new JsonResponse($result, 200);


    }
}