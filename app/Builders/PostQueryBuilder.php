<?php

namespace App\Builders;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PostQueryBuilder
{
    protected Builder $query;
    protected Request $request;

    public function __construct(Request $request = null)
    {
        $this->query = Post::query();
        $this->request = $request ?? request();
    }

    public static function make(Request $request = null): self
    {
        return new static($request);
    }

    public function withRelations(array $relations = ['user', 'category']): self
    {
        $this->query->with($relations);
        return $this;
    }

    public function latest(string $column = 'created_at'): self
    {
        $this->query->latest($column);
        return $this;
    }

    public function applySearch(?string $search = null): self
    {
        $search = $search ?? $this->request->get('search');
        
        if (!empty($search)) {
            $this->query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }
        
        return $this;
    }

    public function applyCategoryFilter($category = null): self
    {
        $category = $category ?? $this->request->get('category');
        
        if ($category && $category !== 'all') {
            if (is_numeric($category)) {
                $this->query->where('category_id', $category);
            } else {
                $this->query->whereHas('category', function ($q) use ($category) {
                    $q->where('slug', $category);
                });
            }
        }
        
        return $this;
    }

    public function applyFilters(array $filters = []): self
    {
        $filters = array_merge([
            'search' => $this->request->get('search'),
            'category' => $this->request->get('category'),
        ], $filters);

        if (!empty($filters['search'])) {
            $this->applySearch($filters['search']);
        }

        if (!empty($filters['category'])) {
            $this->applyCategoryFilter($filters['category']);
        }

        return $this;
    }

    public function paginate(?int $perPage = null): \Illuminate\Pagination\LengthAwarePaginator
    {
        $perPage = $perPage ?? $this->request->get('per_page', 10);
        return $this->query->paginate($perPage);
    }

    public function get(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->query->get();
    }

    /**
     * Optional: Method to get the underlying query builder
     */
    public function getQuery(): Builder
    {
        return $this->query;
    }

    /**
     * Optional: Reset query if needed
     */
    public function reset(): self
    {
        $this->query = Post::query();
        return $this;
    }
}