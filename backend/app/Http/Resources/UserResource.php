<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->buildReturn($this->resource);
    }

    private function buildReturn(User $user): array
    {
        $newlyCreatedReturn = [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'date_created' => $user->created_at,
            ],
            'token' => $user->token
        ];

        $authenticatedReturn = [
            'token' => $user->token
        ];

        return match ($user->state) {
            User::STATE_NEWLY_CREATED => $newlyCreatedReturn,
            User::STATE_AUTHENTICATED => $authenticatedReturn
        };
    }
}
