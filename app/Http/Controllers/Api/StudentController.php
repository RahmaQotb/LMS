<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubjectResource;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function requestSubject(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'غير مصرح'], 401);
        }
    
        $subject = Subject::find($request->subject_id);
        if (!$subject) {
            return response()->json(['message' => 'المادة غير موجودة'], 404);
        }
    
        $existingRequest = $user->subjects()
            ->where('subject_id', $subject->id)
            ->first();
    
        if ($existingRequest) {
            $status = $existingRequest->pivot->status;
    
            switch ($status) {
                case 'مقبول':
                    return response()->json([
                        'message' => 'تم قبول طلبك لهذه المادة',
                        'subject' => new SubjectResource($subject)
                    ], 200);
    
                case 'مرفوض':
                    return response()->json([
                        'message' => 'تم رفض طلبك لهذه المادة'
                    ], 200);
    
                case 'قيد المعالجة':
                    // التحديث باستخدام Query Builder (مع الأقواس)
                    $user->subjects()->updateExistingPivot($subject->id, [
                        'status' => 'قيد المعالجة',
                        'updated_at' => now()
                    ]);
    
                    return response()->json([
                        'message' => 'تم تحديث طلبك السابق'
                    ], 200);
            }
        }
    
        // الإنشاء باستخدام Query Builder (مع الأقواس)
        $user->subjects()->attach($subject->id, [
            'status' => 'قيد المعالجة',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    
        return response()->json([
            'message' => 'تم تقديم طلبك بنجاح'
        ], 201);
    }







  
}
