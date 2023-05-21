<?php
/**
 * Copyright © kushal kumar All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magentomaster\Nps\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magentomaster\Nps\Api\Data\NpsInterface;
use Magentomaster\Nps\Api\Data\NpsInterfaceFactory;
use Magentomaster\Nps\Api\Data\NpsSearchResultsInterfaceFactory;
use Magentomaster\Nps\Api\NpsRepositoryInterface;
use Magentomaster\Nps\Model\ResourceModel\Nps as ResourceNps;
use Magentomaster\Nps\Model\ResourceModel\Nps\CollectionFactory as NpsCollectionFactory;

class NpsRepository implements NpsRepositoryInterface
{

    /**
     * @var ResourceNps
     */
    protected $resource;

    /**
     * @var NpsInterfaceFactory
     */
    protected $npsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var Nps
     */
    protected $searchResultsFactory;

    /**
     * @var NpsCollectionFactory
     */
    protected $npsCollectionFactory;


    /**
     * @param ResourceNps $resource
     * @param NpsInterfaceFactory $npsFactory
     * @param NpsCollectionFactory $npsCollectionFactory
     * @param NpsSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceNps $resource,
        NpsInterfaceFactory $npsFactory,
        NpsCollectionFactory $npsCollectionFactory,
        NpsSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->npsFactory = $npsFactory;
        $this->npsCollectionFactory = $npsCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(NpsInterface $nps)
    {
        try {
            $this->resource->save($nps);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the nps: %1',
                $exception->getMessage()
            ));
        }
        return $nps;
    }

    /**
     * @inheritDoc
     */
    public function get($npsId)
    {
        $nps = $this->npsFactory->create();
        $this->resource->load($nps, $npsId);
        if (!$nps->getId()) {
            throw new NoSuchEntityException(__('Nps with id "%1" does not exist.', $npsId));
        }
        return $nps;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->npsCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(NpsInterface $nps)
    {
        try {
            $npsModel = $this->npsFactory->create();
            $this->resource->load($npsModel, $nps->getNpsId());
            $this->resource->delete($npsModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Nps: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($npsId)
    {
        return $this->delete($this->get($npsId));
    }
}

