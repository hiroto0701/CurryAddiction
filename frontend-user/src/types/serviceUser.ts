import type { FavoriteGenre, FavoritePrefecture } from '@/types/favorite';

export interface ServiceUser {
  id: number;
  user_id: number;
  uuid: string;
  handle_name: string;
  display_name: string;
  avatar_url: string | null;
  registered_at: string;
  post_summary: number;
  favorite_genres: FavoriteGenre[];
  favorite_prefectures: FavoritePrefecture[];
  is_mine: boolean;
}
