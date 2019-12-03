<?php
    namespace Theme\Contexts;

    use IO\Helper\ContextInterface;
    use Ceres\Contexts\SingleItemContext;

    use IO\Services\ItemSearch\Services\ItemSearchService;
    use IO\Services\ItemSearch\SearchPresets\CrossSellingItems;

    class ThemeSingleItemContext extends SingleItemContext implements ContextInterface
    {
    	public $accessory;

    	public function init($params)
    	{
    		parent::init($params);
    		$options = array(
            			"itemId" => $this->item['documents'][0]['data']['item']['id'],
            			"relation" => "ReplacementPart"
           		);
         		$searchfactory = CrossSellingItems::getSearchFactory( $options );
         		$searchfactory->setPage(1, 8); // Begrenze auf 8 Artikel
          		$result = pluginApp(ItemSearchService::class)->getResult($searchfactory);
          		$this->accessory = $result['documents'];
    	}
    }