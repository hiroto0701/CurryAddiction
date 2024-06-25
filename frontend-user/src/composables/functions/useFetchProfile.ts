import axios from 'axios'
import type { ServiceUser } from '@/composables/types/serviceUser'

export const useFetchProfile = () => {
  async function fetchProfile(username: string): Promise<ServiceUser> {
    const response = await axios.get(`/api/${username}`)
    return response.data.data
  }

  return { fetchProfile }
}
