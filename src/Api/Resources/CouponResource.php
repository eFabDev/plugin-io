<?php //strict

namespace IO\Api\Resources;

use Plenty\Plugin\Http\Response;
use Plenty\Plugin\Http\Request;
use IO\Api\ApiResource;
use IO\Api\ApiResponse;
use IO\Api\ResponseCode;
use IO\Services\CouponService;

class CouponResource extends ApiResource
{
    public function __construct(Request $request, ApiResponse $response)
    {
        parent::__construct($request, $response);
    }
    
    public function index():Response
    {
        return $this->response->create([], ResponseCode::OK);
    }
    
    public function store():Response
    {
        $couponCode = $this->request->get('couponCode', '');
    
        /**
         * @var CouponService $couponService
         */
        $couponService = pluginApp(CouponService::class);
        try {
            $response = $couponService->setCoupon($couponCode);
            return $this->response->create( $response, ResponseCode::CREATED );
        } catch (\Exception $e) {
            return $this->response->create( null, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    
    public function destroy(string $selector):Response
    {
        /**
         * @var CouponService $couponService
         */
        $couponService = pluginApp(CouponService::class);
        $response = $couponService->removeCoupon();
    
        return $this->response->create( $response, ResponseCode::CREATED );
    }
}
