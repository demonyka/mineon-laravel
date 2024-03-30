<?php

namespace App\Models;

use App\Services\Storage\SkinUploadService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $username
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected SkinUploadService $skinUploadService;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->skinUploadService = new SkinUploadService();
    }

    /**
     * @throws \Exception
     */
    public function attachSkin(UploadedFile $skin): void
    {
        $this->skinUploadService->upload(
            $skin,
            $this->username,
            [[64, 64], [64, 32]],
            'skins'
        );
    }

    /**
     * @throws \Exception
     */
    public function attachCape(UploadedFile $cape): void
    {
        $this->skinUploadService->upload(
            $cape,
            $this->username,
            [[64, 64], [64, 32]],
            'capes'
        );
    }
}
