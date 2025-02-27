<?php

namespace App\Traits;

trait HandleUploads {

    public function checkAndAssignImgPaths($request, array &$imagePaths, string $repo): void 
    {
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store("uploads/$repo", 'public');
            }
        }
    }

    public function checkAndAssignBcgPath($request, string $repo)
    {
        return $request->hasFile('background_image') ? $request->file('background_image')->store("uploads/$repo", 'public') : null;
    }

    public function checkAndAssignImgPath($request, string $repo)
    {
        return $request->hasFile('image') ? $request->file('image')->store("uploads/$repo", 'public') : null;
    }
}