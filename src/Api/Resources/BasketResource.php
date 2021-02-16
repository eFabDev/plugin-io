<?php //strict

namespace IO\Api\Resources;

use Plenty\Modules\Frontend\Services\VatService;
use Plenty\Plugin\Http\Response;
use Plenty\Plugin\Http\Request;
use IO\Api\ApiResource;
use IO\Api\ApiResponse;
use IO\Api\ResponseCode;
use IO\Services\BasketService;

/**
 * Class BasketResource
 *
 * Resource class for the route `io/basket`.
 * @package IO\Api\Resources
 */
class BasketResource extends ApiResource
{
    /**
     * @var BasketService $basketService Instance of the BasketService.
     */
    private $basketService;

    /**
     * @var VatService $vatService Instance of the BasketService.
     */
    private $vatService;

    /**
     * BasketResource constructor.
     * @param Request $request
     * @param ApiResponse $response
     * @param BasketService $basketService
     * @param VatService $vatService
     */
    public function __construct(Request $request, ApiResponse $response, BasketService $basketService, VatService $vatService)
    {
        parent::__construct($request, $response);
        $this->basketService = $basketService;
        $this->vatService    = $vatService;
    }

    /**
     * Get the basket.
     * @return Response The basket.
     */
    public function index(): Response
    {
        $basket                  = $this->basketService->getBasketForTemplate();
        $basket['totalVats']     = $this->vatService->getCurrentTotalVats();

		return $this->response->create($basket, ResponseCode::OK);
	}
}
