export interface Analytics {
  date: string;
  count: number;
}

export interface AnalyticsResponse {
  data: Analytics[];
}
