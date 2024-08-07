export interface Trash {
  id: number;
  user_id: number;
  store_name: string;
  comment: string;
  post_img: string;
  posted_at: string;
  deleted_at: string;
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

export interface TrashResponse {
  data: Trash[];
  meta: PaginationStatus;
}
