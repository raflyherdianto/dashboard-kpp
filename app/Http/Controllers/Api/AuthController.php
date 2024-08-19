<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    use ApiResponse;
    public function login(Request $request)
    {
        try {
            $validateData = $request->validate([
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:6',
            ]);

            if (!auth()->attempt($validateData)) {
                return $this->errorResponse('Invalid credentials', 401);
            }

            $user = User::where('email', $request->get('email'))->first();

            if (!$user || !Hash::check($request->get('password'), $user->password)) {
                return $this->errorResponse('Credentials not match', 401);
            }
            $token = $user->createToken('auth_token')->plainTextToken;

            return $this->successResponse(['token' => $token], 'Login success');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 500);
        }
    }
    public function getUser(Request $request)
    {
        try {
            return $this->successResponse($request->user());
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 500);
        }
    }
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return $this->successResponse([], 'Logout success');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 500);
        }
    }

    public function register(Request $request)
    {

        $validateData = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'nip' => 'required|unique:users',
        ]);

        try {
            $validateData['password'] = Hash::make($validateData['password']);
            $user =  User::create($validateData);
            $token = $user->createToken('auth_token')->plainTextToken;
            return $this->successResponse(['token' => $token], 'Register success');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 500);
        }
    }

    public function updateProfile(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->user()->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $validateData['image'] = $file->store('user', 'public');
                if ($request->user()->image) {
                    Storage::delete('public/' . $request->user()->image);
                }
            }
            $request->user()->update($validateData);
            return $this->successResponse([], 'Profile has been updated');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 500);
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            $user = auth()->user();
            $validateData = $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:6',
                'new_password_confirmation' => 'required|min:6|same:new_password',
            ]);

            if (!Hash::check($validateData['current_password'], $user->password)) {
                return $this->errorResponse('Current password not match', 401);
            }
            if ($validateData['current_password'] == $validateData['new_password']) {
                return $this->errorResponse('Current password and new password cannot be same', 401);
            }
            unset($validateData['current_password']);
            unset($validateData['new_password_confirmation']);
            $validateData['password'] = Hash::make($validateData['new_password']);
            unset($validateData['new_password']);
            $request->user()->update($validateData);
            return $this->successResponse([], 'Password has been reset');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 500);
        }
    }
}
