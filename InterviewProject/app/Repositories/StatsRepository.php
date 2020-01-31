<?php
namespace App\Repositories;
use App\Charts\OrdersChart;
use App\Mail\ReportMail;
use App\Models\Client;
use App\Models\Product;

class StatsRepository extends BaseRepository
{
    private $client;
    private $chart;
    private $types = [
            "client",
            "product",
            "total",
            "date"
    ];

    /**
     *  First init of repository main model (Product) and init other objects;
     * StatsRepository constructor.
     * @param Product $model
     * @param Client $client
     * @param OrdersChart $chart
     */
    public function __construct(Product $model, Client $client,  OrdersChart $chart) {
        parent::__construct($model);
        $this->client = $client;
        $this->chart = $chart;
    }

    /**
     * Index Page Function
     * @param $attr
     * @return array
     */
    public function index($attr) {

        $types = $this->types;
        $chart = $this->chart;

        // Get builder with current filtered data
        $builder = $this->returnProducts($attr);

        // Init chart - we send builder becouse its more simple to pluck date and on page we will see all static of all date not only date from cureent pagination page
        $this->initChart($chart, $builder);

        // Paginate Orders list for table
        $products = $builder->paginate(10);

        return [$products, $types, $attr, $chart];
    }

    /**
     * Init Chart Function
     * @param $chart
     * @param $builder
     * @return mixed
     */
    private function initChart($chart, $builder) {

        //Set Labels for chart
        $chart->labels($builder->pluck('date'));

        // Set Date for chart
        $chart->dataset('My dataset', 'line', $builder->pluck('total'));

        return $chart;
    }

    /**
     * Main logic of filteres and sorts in table. That all we need for filtering our date and also save filtered values after pagination or refreshing page
     * @param $attr
     * @return mixed
     */
    private function returnProducts($attr) {

        // Check if exist sortedBy attribut we will init it or add default sort value
        $sort = isset($attr['sortedBy']) ? $this->types[$attr['sortedBy']] : 'date';

        // Init builder with select list. We use join for simple usable client table name value becouse without this line filter date will be very hard
        $result = $this->model->join('clients', 'client_id', '=', 'clients.id')->select('products.id' ,'product', 'total', 'date' , 'clients.name AS client');

        // Check if existi keyword and if its doen't empty
       if(isset($attr['keyword']) && $attr['keyword']) {

            // If Current column for search doen't selected we will generate search with keyword in all columns, on another way we return generateDateForSearch method response
            $searchBy = empty($attr['type']) ? ['product', 'total', 'client.name', 'date'] : array($this->generateDateForSearch($attr));

            // whereLike its custom method for filter date more simply (inited in AppServiceProvider boot method)
            $result = $result->whereLike($searchBy, $attr['keyword'])->orderBy($sort);
        }else {
            $result = $result->orderBy($sort);
        }

        return $result;
    }

    /**
     * We only check if type not a Client we simply return sended value else we need change type name like name in query select on client.name
     * @param $attr
     * @return string
     */
    private function generateDateForSearch($attr) {
        return $attr['type'] === "client" ? 'client.name' : $attr['type'];
    }

    /**
     * Send Report on function
     * @param $attr
     */
    public function sendReport($attr) {
        $products = $this->model->with('client')->get()->toArray();
        \Mail::send( new ReportMail($products));
    }

    /**
     * Edit Product function
     * @return array
     */
    public function editProducts() {
      $product = $this->currentModel;
      $clients = $this->client->get();
      return [$product, $clients];
    }

    /**
     * Update Product Function
     * @param $attributes
     * @return mixed
     */
    public function updateProduct($attributes) {
        $attributes['date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $attributes['date'])->startOfDay()->toDateTimeString();
        return $this->currentModel->update($attributes);
    }

    /**
     * Delete order from products table
     * @param $attributes
     * @return array
     */
    public function deleteProduct($attributes) {
      $response = [
        'status' => true,
        'msg' => 'Product Deleted',
      ];

      try{

        $this->currentModel->delete();
        return $response;

      } catch (\Throwable $e) {
        return $response = [
          'status' => false,
          'msg' => 'Something whent wrong',
        ];
      }
    }
}
