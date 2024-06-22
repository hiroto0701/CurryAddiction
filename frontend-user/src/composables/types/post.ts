export interface Post {
  id: string
  genre_id: number | null
  region_id: number | null
  prefecture_id: number | null
  store_name: string
  comment: string
  post_img: string
  latitude: number | null
  longitude: number | null
  posted_at: string
  errors: Record<string, string[]>
}

export interface PaginationStatus {
  from: number | null
  to: number | null
  total: number | null
  current_page: number | null
  last_page: number | null
  per_page: number | null
}

export interface PostsResponse {
  data: Post[]
  meta: PaginationStatus
}
