import type { FavoriteGenre } from '@/stores/account';
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
  is_mine: boolean;
}
