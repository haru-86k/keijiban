$recommended_anime = array_filter($anime_list, function($anime) {
    return $anime['is_recommended']; // おすすめ作品だけを抽出
});
