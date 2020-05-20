<?php

namespace Fronds\Services\ContentServices;

use Fronds\Http\Resources\Page\PageCollection;
use Fronds\Lib\Exceptions\FrondsException;
use Fronds\Repositories\Content\PageRepository;
use Fronds\Services\FrondsService;
use Illuminate\Support\Arr;

class PageService extends FrondsService
{

    /**
     * @var PageRepository
     */
    private PageRepository $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * @param  array  $pageData
     * @return string
     * @throws FrondsException
     */
    public function addNewPage(array $pageData): string
    {
        return $this->pageRepository->writePage($pageData)->id;
    }

    /**
     * @param  array  $pageData
     * @param  string  $id
     * @return bool
     * @throws FrondsException
     */
    public function updatePage(array $pageData, string $id): bool
    {
        // I don't want to be too terse. Debugging gets painful,
        // as can maintenance and refactoring
        $combinedArr = Arr::add($pageData, 'id', $id);
        return $this->pageRepository->writePage($combinedArr)->id === $id;
    }

    /**
     * Grabs all pages with optional pagination
     * @param  bool  $paginated
     * @param  int  $perPage
     * @return array
     * @throws FrondsException
     */
    public function pagesForDisplay(bool $paginated = true, int $perPage = 10): array
    {
        $columnsToSearch = ['page_title', 'slug', 'page_layout', 'id'];
        $pagesToDisplay = [
            'columns' => [
                'Page Title',
                'Slug'
            ],
            'hidden' => [
                'layout',
                'id'
            ],
            'values' => []
        ];
        // there's a resource setup to map everything already to an array
        if ($paginated) {
            $pages = new PageCollection($this->pageRepository->getAllPagesPaginated($columnsToSearch, $perPage));
            $pagesToDisplay['values'] = $pages;
        } else {
            $pagesToDisplay['values'] = $this->pageRepository->getAll($columnsToSearch);
        }

        return $pagesToDisplay;
        // TODO: finish implementation
        // regular collection mapped correctly
    }
}
