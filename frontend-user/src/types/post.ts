export interface Post {
  id: number;
  genre_id: number;
  region_id: number;
  prefecture_id: number;
  store_name: string;
  comment: string;
  latitude: number;
  longitude: number;
  official_name: string;
  formatted_address: string;
  postcode: string;
  prefecture: string;
  municipality: string;
  ward?: string;
  district: string;
  slug: string;
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
