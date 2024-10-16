export const PREFECTURE_LIST = [
  { prefId: 1, name: '北海道', regionId: 1, regionName: '北海道地方' },
  { prefId: 2, name: '青森県', regionId: 2, regionName: '東北地方' },
  { prefId: 3, name: '岩手県', regionId: 2, regionName: '東北地方' },
  { prefId: 4, name: '宮城県', regionId: 2, regionName: '東北地方' },
  { prefId: 5, name: '秋田県', regionId: 2, regionName: '東北地方' },
  { prefId: 6, name: '山形県', regionId: 2, regionName: '東北地方' },
  { prefId: 7, name: '福島県', regionId: 2, regionName: '東北地方' },
  { prefId: 8, name: '茨城県', regionId: 3, regionName: '関東地方' },
  { prefId: 9, name: '栃木県', regionId: 3, regionName: '関東地方' },
  { prefId: 10, name: '群馬県', regionId: 3, regionName: '関東地方' },
  { prefId: 11, name: '埼玉県', regionId: 3, regionName: '関東地方' },
  { prefId: 12, name: '千葉県', regionId: 3, regionName: '関東地方' },
  { prefId: 13, name: '東京都', regionId: 3, regionName: '関東地方' },
  { prefId: 14, name: '神奈川県', regionId: 3, regionName: '関東地方' },
  { prefId: 15, name: '新潟県', regionId: 4, regionName: '中部地方' },
  { prefId: 16, name: '富山県', regionId: 4, regionName: '中部地方' },
  { prefId: 17, name: '石川県', regionId: 4, regionName: '中部地方' },
  { prefId: 18, name: '福井県', regionId: 4, regionName: '中部地方' },
  { prefId: 19, name: '山梨県', regionId: 4, regionName: '中部地方' },
  { prefId: 20, name: '長野県', regionId: 4, regionName: '中部地方' },
  { prefId: 21, name: '岐阜県', regionId: 4, regionName: '中部地方' },
  { prefId: 22, name: '静岡県', regionId: 4, regionName: '中部地方' },
  { prefId: 23, name: '愛知県', regionId: 4, regionName: '中部地方' },
  { prefId: 24, name: '三重県', regionId: 5, regionName: '近畿地方' },
  { prefId: 25, name: '滋賀県', regionId: 5, regionName: '近畿地方' },
  { prefId: 26, name: '京都府', regionId: 5, regionName: '近畿地方' },
  { prefId: 27, name: '大阪府', regionId: 5, regionName: '近畿地方' },
  { prefId: 28, name: '兵庫県', regionId: 5, regionName: '近畿地方' },
  { prefId: 29, name: '奈良県', regionId: 5, regionName: '近畿地方' },
  { prefId: 30, name: '和歌山県', regionId: 5, regionName: '近畿地方' },
  { prefId: 31, name: '鳥取県', regionId: 6, regionName: '中国地方' },
  { prefId: 32, name: '島根県', regionId: 6, regionName: '中国地方' },
  { prefId: 33, name: '岡山県', regionId: 6, regionName: '中国地方' },
  { prefId: 34, name: '広島県', regionId: 6, regionName: '中国地方' },
  { prefId: 35, name: '山口県', regionId: 6, regionName: '中国地方' },
  { prefId: 36, name: '徳島県', regionId: 7, regionName: '四国地方' },
  { prefId: 37, name: '香川県', regionId: 7, regionName: '四国地方' },
  { prefId: 38, name: '愛媛県', regionId: 7, regionName: '四国地方' },
  { prefId: 39, name: '高知県', regionId: 7, regionName: '四国地方' },
  { prefId: 40, name: '福岡県', regionId: 8, regionName: '九州地方' },
  { prefId: 41, name: '佐賀県', regionId: 8, regionName: '九州地方' },
  { prefId: 42, name: '長崎県', regionId: 8, regionName: '九州地方' },
  { prefId: 43, name: '熊本県', regionId: 8, regionName: '九州地方' },
  { prefId: 44, name: '大分県', regionId: 8, regionName: '九州地方' },
  { prefId: 45, name: '宮崎県', regionId: 8, regionName: '九州地方' },
  { prefId: 46, name: '鹿児島県', regionId: 8, regionName: '九州地方' },
  { prefId: 47, name: '沖縄県', regionId: 8, regionName: '九州地方' }
];

export function convertPrefectureNameToPrefId(prefectureName: string): number | null {
  return PREFECTURE_LIST.find((prefecture) => prefecture.name === prefectureName)?.prefId ?? null;
}

export function convertPrefectureNameToRegionId(prefectureName: string): number | null {
  return PREFECTURE_LIST.find((prefecture) => prefecture.name === prefectureName)?.regionId ?? null;
}
