<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpensesRequest;
use App\Http\Resources\ExpensesResource;
use App\Jobs\SendExpenseCreateEmail;
use App\Models\Expense;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends BaseController
{
    public function index(): JsonResponse
    {
        $user = Auth::user();
        $expense = Expense::whereBelongsTo($user)->get();

        return $this->sendResponse((new ExpensesResource($expense))->resource, 'All the expenses was loaded');
    }

    public function store(ExpensesRequest $request): JsonResponse
    {
        try {
            $user = Auth::user();
            $user->expense()->create($request->toArray());
            $expense = null;
            foreach ($user->expense as $model) {
                $expense = $model;
            }
            SendExpenseCreateEmail::dispatch($user);

        } catch (\Throwable $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse(new ExpensesResource($expense), 'Your expense has been successfully registered');
    }

    public function show(string $id): JsonResponse
    {
        try {
            $user = Auth::user();
            $expense = $user->expense()->findOrFail($id);

        } catch (\Throwable $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse(new ExpensesResource($expense));
    }

    public function update(string $id, ExpensesRequest $request): JsonResponse
    {
        try {
            $user = Auth::user();
            $expense = $user->expense()->findOrFail($id);
            $expense->update($request->toArray());
        } catch (\Throwable $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse(new ExpensesResource($expense), 'Your expense has been successfully updated');
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $user = Auth::user();
            $expense = $user->expense()->findOrFail($id);
            $expense->delete();
        } catch (\Throwable $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse(new ExpensesResource($expense), 'Your expense has been successfully deleted');
    }
}
