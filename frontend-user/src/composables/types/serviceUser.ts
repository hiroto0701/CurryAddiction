export interface ServiceUser {
  id: number
  user_id: number
  handle_name: string
  display_name: string
  avatar_url: string | null
  registered_at: string
  post_summary: number
  is_mine: boolean
}

// export interface ServiceUserResponse {
//   data: Post[]
//   meta: PaginationStatus
// }
