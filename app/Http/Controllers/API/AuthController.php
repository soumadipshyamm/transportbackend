<?php
namespace App\Http\Controllers\API;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
class AuthController extends BaseController
{
    //
    public function login(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'type' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->all(), "");
        }
        if ($request->type == "1") {
            if (!auth()->attempt($request->only(['email', 'password']))) {
                return $this->responseJson(false, 200, 'Incorrect Details. Please try again', []);
            } else {
                $user = auth()->user();
                $data['token'] = $user->createToken('MyApp')->accessToken;
                $data['user'] = $user;
                // dd($data);
                return $this->responseJson(true, 200, 'User Login Successfully', $data);
            }
        } else {
            return $this->responseJson(false, 200, 'Incorrect User Type Please try again', []);
        }
    }
    public function generateToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'refresh_token' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->all(), "");
        }
        $baseUrl = url('/');
        $response = Http::post("{$baseUrl}/oauth/token", [
            'refresh_token' => $request->refresh_token,
            'client_id' => config('passport.password_grant_client.id'),
            'client_secret' => config('passport.password_grant_client.secret'),
            'grant_type' => 'refresh_token',
        ]);
        if ($response->ok()) {
            return $this->responseJson(true, 200, 'New token Generated', $response);
        }
        return $this->responseJson(false, 500, 'Token generation failed', []);
    }
    public function logout(Request $request)
    {
        // dd($request->all());
        $user = $request->user()->token();
        if ($user->revoke()) {
            return $this->responseJson(true, 200, 'User logged out successfully', []);
        }
        return $this->responseJson(false, 400, 'Something went wrong', []);
    }
    public function updatePassword(Request $request)
    {
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'current_password' => [
                'required', function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        return $fail(__('The current password is incorrect.'));
                    }
                }
            ],
            'new_password' => 'required|string|min:6'
        ]);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->all(), "");
        }
        DB::beginTransaction();
        try {
            $password = Hash::make($request->new_password);
            // dd($password);
            $isUserPasswordUpdated = auth()->user()->update([
                'password' => $password
            ]);
            if ($isUserPasswordUpdated) {
                DB::commit();
                return $this->responseJson(true, 200, 'Password Changed Successfully', $isUserPasswordUpdated);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e->getMessage() . 'on' . $e->getFile() . 'in' . $e->getLine());
            return $this->responseJson(false, 500, $e->getMessage(), []);
        }
    }
    public function getProfileUpdate(Request $request)
    {
        $user = auth()->user();
        // dd($user);
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "phone" => "required|string",
            "dob" => "required",
            "gender" => "required",
            'file' => 'image|mimes:jpg,jpeg,png|max:2048',
            // 'current_password'=>'required',
            'current_password' => [
                'required', function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        return $fail(__('The current password is incorrect.'));
                    }
                }
            ],
        ]);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->all(), "");
        }
        if ($request->file('file') == null) {
            $img = '';
        } else {
            $img = carImageUpload($request->file);
        }
        if ($request->new_password == null) {
            DB::beginTransaction();
            try {
                $isUserUpdated = auth()->user()->update([
                    "name" => $request->name,
                    "phone" => $request->phone,
                    "dob" => Carbon::parse($request->dob)->format('d M Y'),
                    "gender" => $request->gender,
                    "img" => $img,
                ]);
                if ($isUserUpdated) {
                    DB::commit();
                    return $this->responseJson(true, 200, 'Profile Updated successfully', $isUserUpdated);
                }
            } catch (\Exception $e) {
                DB::rollBack();
                logger($e->getMessage() . 'on' . $e->getFile() . 'in' . $e->getLine());
                return $this->responseJson(false, 500, $e->getMessage(), '');
            }
        } else {
            $password = Hash::make($request->new_password);
            DB::beginTransaction();
            try {
                $isUserUpdated = auth()->user()->update([
                    "name" => $request->name,
                    "phone" => $request->phone,
                    "dob" => Carbon::parse($request->dob)->format('d M Y'),
                    "gender" => $request->gender,
                    "img" => $img,
                    "password" => $password
                ]);
                if ($isUserUpdated) {
                    DB::commit();
                    return $this->responseJson(true, 200, 'Profile Updated successfully', $isUserUpdated);
                }
            } catch (\Exception $e) {
                DB::rollBack();
                logger($e->getMessage() . 'on' . $e->getFile() . 'in' . $e->getLine());
                return $this->responseJson(false, 500, $e->getMessage(), '');
            }
        }
    }
    public function getProfileUpdateImg(Request $request)
    {
        // $user = auth()->user();
        // dd($user);
        $userId = $request->user_id;
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->all(), "");
        }
        // dd(carImageUpload($request->file));
        $profileImg = carImageUpload($request->file);
        DB::beginTransaction();
        try {
            $isUserProfileImgUpdated = User::where('id', $userId)->update([
                "img" => $profileImg
            ]);
            if ($isUserProfileImgUpdated) {
                DB::commit();
                return $this->responseJson(true, 200, 'Profile  Image Updated successfully', $isUserProfileImgUpdated);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e->getMessage() . 'on' . $e->getFile() . 'in' . $e->getLine());
            return $this->responseJson(false, 500, $e->getMessage(), '');
        }
    }
    public function getProfileUpdateList(Request $request)
    {
        $userDetails = User::where('id', $request->user_id)->get();
        return $this->responseJson(true, 200, 'User Profile Details ', $userDetails[0]);
    }
}
