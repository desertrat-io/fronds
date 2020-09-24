<?php

declare(strict_types=1);

namespace Fronds\Repositories\Structure;

use Fronds\Lib\Exceptions\Data\FrondsCreateEntityException;
use Fronds\Lib\Exceptions\Data\FrondsEntityNotFoundException;
use Fronds\Lib\Exceptions\FrondsException;
use Fronds\Models\MenuDefinition;
use Fronds\Repositories\FrondsRepository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class MenuDefinitionRepository
 *
 * @package Fronds\Repositories\Structure
 * @author  Mike Lawson <mike@desertrat.io>
 * @license MIT https://opensource.org/licenses/MIT
 */
class MenuDefinitionRepository extends FrondsRepository
{

    /**
     * @inheritDoc
     */
    public function getModelClass(): string
    {
        return MenuDefinition::class;
    }

    /**
     * @param  array  $menuDefinitionData
     * @return MenuDefinition
     * @throws FrondsException<FrondsCreateEntityException>
     */
    public function addMenuDef(array $menuDefinitionData): MenuDefinition
    {
        $result = MenuDefinition::create(
            ['menu_title' => $menuDefinitionData['title'], 'menu_type' => $menuDefinitionData['type']]
        );
        fronds_throw_if($result === null, FrondsCreateEntityException::class, 'Problem creating menu');
        return $result;
    }

    /**
     * @param  array|string[]  $columns
     * @param  int  $pageSize
     * @return LengthAwarePaginator
     * @throws FrondsException
     */
    public function getMenuAssetListResults(array $columns = ['*'], int $pageSize = 10): LengthAwarePaginator
    {
        $result = MenuDefinition::select($columns)->with('items')->withCount('items')->paginate($pageSize);
        fronds_throw_if(
            $result === null,
            FrondsEntityNotFoundException::class,
            'Problem getting menus for asset list'
        );
        return $result;
    }
}
