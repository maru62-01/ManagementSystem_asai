<?php

namespace App\Searchs;

use App\Models\Users\User;

class SearchResultFactories
{

    // 改修課題：選択科目の検索機能
    public function initializeUsers($keyword, $category, $updown, $gender, $role, $subjects)
    {
        if ($category == 'name') {
            if (empty($subjects)) {
                $searchResults = new SelectNames();
                // empty　空かどうかの確認を行う配列、変数
            } else {
                $searchResults = new SelectNameDetails();
                // 空じゃ無かったらSelectNameDetailsの実装
            }
            return $searchResults->resultUsers($keyword, $category, $updown, $gender, $role, $subjects);
        } else if ($category == 'id') {
            if (empty($subjects)) {
                $searchResults = new SelectIds();
            } else {
                $searchResults = new SelectIdDetails();
            }
            return $searchResults->resultUsers($keyword, $category, $updown, $gender, $role, $subjects);
        } else {
            $allUsers = new AllUsers();
            return $allUsers->resultUsers($keyword, $category, $updown, $gender, $role, $subjects);
        }
    }
}
