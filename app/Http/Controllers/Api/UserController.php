<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Info(
 *     title="What to Eat API",
 *     version="1.0",
 *     description="API Documentation for What to Eat application"
 * )
 */

class UserController extends Controller
{
    /**
    * @OA\Post(
    *     path="/api/register",
    *     summary="Register a new user",
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             @OA\Property(property="name", type="string", example="John Doe"),
    *             @OA\Property(property="email", type="string", example="john@example.com"),
    *             @OA\Property(property="password", type="string", example="password123"),
    *             @OA\Property(property="password_confirmation", type="string", example="password123"),
    *             @OA\Property(property="privacyPolicies", type="boolean", example=true)
    *         )
    *     ),
    *     @OA\Response(
    *         response=201,
    *         description="Usuario creado correctamente",
    *         @OA\JsonContent(
    *             @OA\Property(property="message", type="string", example="Usuario creado correctamente"),
    *             @OA\Property(property="user", ref="#/components/schemas/User"),
    *             @OA\Property(property="token", type="string", example="token")
    *         )
    *     ),
    *     @OA\Response(
    *         response=422,
    *         description="Validation errors",
    *         @OA\JsonContent(
    *             @OA\Property(property="validation_errors", type="object")
    *         )
    *     )
    * )
    */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'privacyPolicies' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->messages(),
            ], 422);
        } else {

            $user = new User([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

            $user->save();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Usuario creado correctamente',
                'user' => $user,
                'token' => $token,
            ], 201);
        }
    }

    /**
    * @OA\Post(
    *     path="/api/login",
    *     summary="Log in a user",
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             @OA\Property(property="email", type="string", example="john@example.com"),
    *             @OA\Property(property="password", type="string", example="password123")
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Usuario conectado exitosamente",
    *         @OA\JsonContent(
    *             @OA\Property(property="msg", type="string", example="Usuario conectado exitosamente"),
    *             @OA\Property(property="user", ref="#/components/schemas/User"),
    *             @OA\Property(property="token", type="string", example="token")
    *         )
    *     ),
    *     @OA\Response(
    *         response=401,
    *         description="Usuario o contraseña incorrectos",
    *         @OA\JsonContent(
    *             @OA\Property(property="msg", type="string", example="Usuario o contraseña incorrectos")
    *         )
    *     ),
    *     @OA\Response(
    *         response=422,
    *         description="Validation errors",
    *         @OA\JsonContent(
    *             @OA\Property(property="validation_errors", type="object")
    *         )
    *     )
    * )
    */

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->messages(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'msg' => 'Usuario o contraseña incorrectos'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        $cookie = cookie('token', $token, 60 * 24);

        return response()->json([
            'msg' => 'Usuario conectado exitosamente',
            'user' => $user,
            'token' => $token
        ], 200)->withCookie($cookie);
    }

    /**
    * @OA\Post(
    *     path="/api/logout",
    *     summary="Log out a user",
    *     @OA\Response(
    *         response=200,
    *         description="Sesión cerrada correctamente",
    *         @OA\JsonContent(
    *             @OA\Property(property="status", type="integer", example=1),
    *             @OA\Property(property="msg", type="string", example="Sesión cerrada correctamente")
    *         )
    *     ),
    *     @OA\Response(
    *         response=401,
    *         description="No user authenticated",
    *         @OA\JsonContent(
    *             @OA\Property(property="status", type="integer", example=0),
    *             @OA\Property(property="msg", type="string", example="No user authenticated")
    *         )
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Error al cerrar sesión",
    *         @OA\JsonContent(
    *             @OA\Property(property="status", type="integer", example=0),
    *             @OA\Property(property="msg", type="string", example="Error al cerrar sesión")
    *         )
    *     )
    * )
    */
    public function logout(Request $request)
{
    try {
        $user = $request->user();

        if (!$user) {
            return response()->json(['status' => 0, 'msg' => 'No user authenticated'], 401);
        }

        $user->tokens()->delete();
        return response()->json(['status' => 1, 'msg' => 'Sesión cerrada correctamente'], 200);
    } catch (\Exception $e) {
        return response()->json(['status' => 0, 'msg' => 'Error al cerrar sesión'], 500);
    }
}

}
