<script setup lang="ts">
import { ref, onMounted } from 'vue';
import dayjs from 'dayjs';
import type { Dayjs } from 'dayjs';
import type {
  DataRecord,
  DateOptions,
  DataOptions,
  ScaleOptions,
  DomainOptions,
  SubDomain
} from '@/types/heatmap';
import type { Analytics } from '@/types/analytics';
import CalHeatmap from 'cal-heatmap';
import type { CalHeatmapOptions, TooltipOptions } from 'cal-heatmap';
import Tooltip from 'cal-heatmap/plugins/Tooltip';

interface Props {
  readonly analyticsData: Analytics[];
}
const props = defineProps<Props>();

const today: string = dayjs().format('YYYY-MM-DD');
// UIのためにカレンダーの開始日を2カ月前に設定
const calStartDate: string = dayjs().subtract(2, 'month').format('YYYY-MM-DD');
const visibleMonths = ref<number>(12);
const heatmapData = props.analyticsData.map((item) => ({ date: item.date, value: item.count }));
const cal: CalHeatmap = new CalHeatmap();

function paintCalendar() {
  const dateOptions: DateOptions = {
    start: dayjs.utc(calStartDate).toDate(),
    highlight: [dayjs.utc(today).toDate()],
    locale: 'ja',
    timezone: 'Asia/Tokyo'
  };

  const dataOptions: DataOptions = {
    source: heatmapData,
    type: 'json',
    x: 'date',
    y: (d: DataRecord) => +d['value'],
    defaultValue: null
  };

  const scaleOptions: ScaleOptions = {
    color: {
      type: 'threshold',
      range: ['#e6e6e6', '#4dd05a'],
      domain: [0, 1]
    }
  };

  const domainOptions: DomainOptions = {
    type: 'month',
    gutter: 2,
    label: {
      text: 'M月',
      position: 'top',
      textAlign: 'start',
      offset: {
        x: 0,
        y: 0
      },
      rotate: null
    },
    sort: 'asc'
  };

  const subDomain: SubDomain = {
    type: 'ghDay',
    gutter: 2,
    width: 11,
    height: 11,
    radius: 2,
    label: null
  };

  const TOOLTIP_OPTIONS: TooltipOptions = {
    enabled: true,
    text: (_: unknown, value: number | null, dayjsDate: Dayjs) => {
      return `${value ?? 0} 件の投稿 ${dayjs(dayjsDate).format('YYYY/MM/DD')}`;
    }
  };

  const options: CalHeatmapOptions = {
    date: dateOptions,
    data: dataOptions,
    range: visibleMonths.value,
    scale: scaleOptions,
    domain: domainOptions,
    subDomain,
    itemSelector: '#heatmap'
  };

  cal.paint(options, [[Tooltip, TOOLTIP_OPTIONS]]);
}

onMounted(() => paintCalendar());
</script>
<template>
  <div
    class="relative"
    :style="{
      color: '#adbac7',
      borderRadius: '3px'
    }"
  >
    <div id="heatmap"></div>
    <div class="sticky bottom-0 left-0 my-3 flex items-center gap-2">
      <a
        class="flex h-6 w-16 items-center justify-center rounded-lg bg-gray-100 font-body text-mini text-sumi-700 duration-300 hover:bg-gray-200"
        href="#"
        @click.prevent="cal.previous()"
      >
        ← Prev
      </a>
      <a
        class="flex h-6 w-16 items-center justify-center rounded-lg bg-gray-100 font-body text-mini text-sumi-700 duration-300 hover:bg-gray-200"
        href="#"
        @click.prevent="cal.next()"
      >
        Next →
      </a>
    </div>
  </div>
</template>
<style>
#ch-tooltip {
  @apply flex select-none items-center justify-center whitespace-nowrap rounded-lg border border-gray-200 bg-white px-2 py-2 font-body text-xs text-sumi-500 shadow-sm;
  transition: opacity 0.1s ease-out;
  opacity: 0;
}

#ch-tooltip[data-show] {
  opacity: 1;
}
</style>
