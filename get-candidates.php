<?php


$party_map = array(
    '國會政黨聯盟' => 19,
    '時代力量' => 11,
    '宗教聯盟' => 20,
    '台灣基進' => 21,
    '民主進步黨' => 1,
    '勞動黨' => 22,
    '中國國民黨' => 9,
    '綠黨' => 23,
    '親民黨' => 2,
    '台灣民眾黨' => 24,
    '台灣團結聯盟' => 10,
    '台灣維新' => 25,
    '台澎黨' => 26,
    '中華統一促進黨' => 8,
    '喜樂島聯盟' => 27,
    '新黨' => 16,
    '合一行動聯盟' => 28,
    '一邊一國行動黨' => 29,
    '安定力量' => 30,
);
$fp = fopen('https://docs.google.com/spreadsheets/d/e/2PACX-1vT9klmFUCak2M2sjHEUFm6xFZn_az8lOJbFAZyi41S7bgQMBfmZn8BWUIvJNYInlKyFQQrxyDxKbzeg/pub?gid=1153115969&single=true&output=csv', 'r');
$ret = array();
$columns = fgetcsv($fp);
while ($rows = fgetcsv($fp)) {
    list(, $party, $seq, $name, $gender,) = $rows;
    if (!array_key_exists($party, $party_map)) {
        throw new Exception("{$party} not found");
    }
    $ret[] = array(
        'drawno' => $party_map[$party],
        'candidatename' => $name,
        'nosequence' => intval($seq),
        'gender' => ($gender == '男') ? 'M': 'F',
    );
}
file_put_contents('candidates.json', json_encode(array('全國不分區及僑居國外國民立委公報' => $ret), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
