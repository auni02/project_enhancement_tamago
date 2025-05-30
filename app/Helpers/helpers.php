<?php

// app/Helpers/helpers.php

if (!function_exists('checkRole')) {
    function checkRole($role)
    {
        if (!auth()->check()) {
            abort(403, 'User not authenticated.');
        }

        $user = auth()->user();

        // Optional: log or debug current role
        // logger('User Role: ' . $user->role);

        if ($user->role !== $role) {
            abort(403, 'Unauthorized action. Your role: ' . $user->role . ', required: ' . $role);
        }
    }
}
