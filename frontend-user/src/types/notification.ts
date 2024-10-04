export interface Notification {
  id: string;
  notified_target: {
    post_id: number;
    slug: string;
    store_name: string;
  };
  notified_from_user: {
    user_id: number;
    display_name: string;
    handle_name: string;
    avatar_url: string | null;
  };
  created_at: string;
  read_at: string;
  errors?: Record<string, string[]>;
}

export interface PaginationStatus {
  from: number | null;
  to: number | null;
  total: number | null;
  current_page: number | null;
  last_page: number | null;
  per_page: number | null;
  has_more_pages?: boolean;
  next_page: number | null;
}

export interface NotificationsResponse {
  data: Notification[];
  meta: PaginationStatus;
}
