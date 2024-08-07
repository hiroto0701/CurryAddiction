export interface Post {
  id: number;
  genre_id: number | null;
  region_id: number | null;
  prefecture_id: number | null;
  store_name: string;
  comment: string;
  latitude: string | null;
  longitude: string | null;
  post_img: string;
  posted_at: string;
  posted_by: number;
  user: {
    user_id: number;
    display_name: string;
    handle_name: string;
    avatar_url: string | null;
  };
  is_mine: boolean;
  current_user_liked: boolean;
  current_user_archived: boolean;
  errors?: Record<string, string[]>;
}

export interface PaginationStatus {
  from: number | null;
  to: number | null;
  total: number | null;
  current_page: number | null;
  last_page: number | null;
  per_page: number | null;
}

export interface PostsResponse {
  data: Post[];
  meta: PaginationStatus;
}
