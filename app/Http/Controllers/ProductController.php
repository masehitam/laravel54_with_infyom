<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use App\Http\Controllers\AppBaseController;
use App\Utility\FileUtility;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Storage;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProductController extends AppBaseController
{
    /** @var  ProductRepository */
    private $productRepository;

	/** @var  CategoryRepository */
	private $categoryRepository;

    public function __construct(ProductRepository $productRepo, CategoryRepository $categoryRepo)
    {
        $this->productRepository = $productRepo;
	    $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Product.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->productRepository->pushCriteria(new RequestCriteria($request));
        $products = $this->productRepository->all();

        return view('products.index')
            ->with('products', $products);
    }

    /**
     * Show the form for creating a new Product.
     *
     * @return Response
     */
    public function create()
    {
	    $categories = $this->categoryRepository->pluck('name', 'id');
        return view('products.create')
	            ->with('selectedCategory', '')
	            ->with('categories', $categories);
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param CreateProductRequest $request
     *
     * @return Response
     */
    public function store(CreateProductRequest $request)
    {
	    $input = $request->all();

	    $input['picture'] = FileUtility::saveUploadImage('picture', Product::BASE_PATH);

        $product = $this->productRepository->create($input);

        Flash::success('Product saved successfully.');

        return redirect(route('products.index'));
    }

    /**
     * Display the specified Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

	    $categories = $this->categoryRepository->pluck('name', 'id');

        return view('products.edit')
	        ->with('product', $product)
	        ->with('selectedCategory', $product->category->id)
	        ->with('categories', $categories);
    }

    /**
     * Update the specified Product in storage.
     *
     * @param  int              $id
     * @param UpdateProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductRequest $request)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

	    $input = $request->all();
	    $input['picture'] = FileUtility::saveEditUploadImage($input, $product->picture, 'picture', Product::BASE_PATH, 'isDelete');

        $product = $this->productRepository->update($input, $id);

        Flash::success('Product updated successfully.');

        return redirect(route('products.index'));
    }

    /**
     * Remove the specified Product from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        $this->productRepository->delete($id);

        Flash::success('Product deleted successfully.');

        return redirect(route('products.index'));
    }
}
