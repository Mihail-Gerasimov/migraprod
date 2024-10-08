<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Order\CreateRequest;
use App\Services\OrderService;
use Illuminate\Http\Response;

class CreateOrderController extends Controller
{
    public function __construct(
        private OrderService $service
    )
    {} //Конструктор

    public function __invoke(CreateRequest $request)
    {
        $_data = '';
        if (is_array($request->input('data'))) {
            foreach ($request->input('data') as $qa) {
                if (is_array($qa['answer']))
                    $_data .= "Вопрос: " . $qa['question'] . " Ответ: " . implode(',', $qa['answer']);
                else
                    $city = isset($qa['city']) ? $qa['city'] : '';
                $_data .= "Вопрос: " . $qa['question'] . " Ответ: " . $qa['answer'] . $city . ' ';
            }
        }


        if ($request->has('messenger')) $_data = $_data . ' Мессенджер: '. $request->input('messenger');

        $request->merge([
            'data' => $_data,
        ]);

        $this->service->leadHunterAdd(token: 'dfqTAL8GabLyl8PFGHgXFdsb12DUg8BPa7rf0LEsh4PoDvBCjNe3UFLvqwY1', request: $request );

        $this->service->leadAdd($request);
        //return response(content: 'Лид создан', status: Response::HTTP_CREATED);
        return  response()->json( ['data' => $request->all() ,'page' => 'thanks'],  Response::HTTP_CREATED);
    } //__invoke
}
