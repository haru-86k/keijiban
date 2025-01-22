<?php
// アニメリストを配列として定義
$anime_list = [
    ['id' => 1, 'title' => 'Mobile Suit Gundam', 'description' => 'The original Gundam series', 'is_recommended' => true],
    ['id' => 2, 'title' => 'Zeta Gundam', 'description' => 'Sequel to the original Gundam', 'is_recommended' => true],
    ['id' => 3, 'title' => 'Gundam Wing', 'description' => 'Alternative universe series', 'is_recommended' => false],
    // 他のアニメもここに追加できます
];

// おすすめのアニメをフィルタリング
$recommended_anime = array_filter($anime_list, function($anime) {
    return $anime['is_recommended'];
});

// おすすめアニメを表示
foreach ($recommended_anime as $anime) {
    echo '<p>' . $anime['title'] . ': ' . $anime['description'] . '</p>';
}
?>
