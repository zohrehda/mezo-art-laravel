<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\PersonalAccessToken;
use App\Traits\ApiResponseBuilderTrait;
use Illuminate\Database\Eloquent\Builder;
 use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Request::macro('apiValidate', function ($rules, $data = null) {

            $data = $data ?? $this->all();
            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            return $validator;
        });
          $self = $this;
        Builder::macro('paginate22', function () use ($self) {
            $per_page = request()->input('per_page') ?? 10;
            $paginator = $this->paginate($per_page);
            return $self->response('data retrieved in pagination', $paginator->items(), 200, [
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'current_page' => $paginator->currentPage()

            ]);
        });
    }
}
