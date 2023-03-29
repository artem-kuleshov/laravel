<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

    protected $table = 'posts';
    protected $guarded = [];

    private $tags_in = [];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @throws \Exception
     */
    public function saveData(array $data): void
    {
        $data = $this->prepareData($data);

        try {
            DB::beginTransaction();

            $post = Post::create($data);
            $this->linkTagsForInsert($post);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * @throws \Exception
     */
    public function updateData(array $data): void
    {
        $data = $this->prepareData($data);

        try {
            DB::beginTransaction();

            $this->update($data);
            $this->linkTagsSync();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    private function prepareData(array $data): array
    {
        if (isset($data['tags'])) {
            $this->tags_in = $data['tags'];
            unset($data['tags']);
        }

        return $data;
    }

    private function linkTagsSync(): void
    {
        if ($this->tags_in) {
            $this->tags()->sync($this->tags_in);
        }
    }

    private function linkTagsForInsert(self $post)
    {
        if ($this->tags_in) {
            $post->tags()->attach($this->tags_in);
        }
    }

}
