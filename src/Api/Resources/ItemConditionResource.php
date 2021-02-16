<?php //strict

namespace IO\Api\Resources;

use Plenty\Plugin\Http\Response;
use Plenty\Plugin\Http\Request;
use IO\Api\ApiResource;
use IO\Api\ApiResponse;
use IO\Api\ResponseCode;
use IO\Services\ItemService;


/**
 * Class ItemConditionResource
 *
 * Resource class for the route "io/item/condition".
 * @package IO\Api\Resources
 */
class ItemConditionResource extends ApiResource
{
    /**
     * @var ItemService
     */
    private $itemService;
    
    
    /**
     * ItemConditionResource constructor.
     * @param Request $request
     * @param ApiResponse $response
     * @param ItemService $itemService
     */
    public function __construct(Request $request, ApiResponse $response, ItemService $itemService)
    {
        parent::__construct($request, $response);
        $this->itemService = $itemService;
    }
    
    /**
     * @param string $conditionId
     * @return Response
     */
    public function show(string $conditionId):Response
    {
        $conditionText = '';
        
        if((int)$conditionId > 0)
        {
            $conditionText = $this->itemService->getItemConditionText((int)$conditionId);
        }
        
        return $this->response->create($conditionText, ResponseCode::OK);
    }
}