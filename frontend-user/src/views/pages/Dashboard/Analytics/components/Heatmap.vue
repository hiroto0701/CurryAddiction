<script setup lang="ts">
import dayjs from 'dayjs'
import { ref, onMounted } from 'vue'
import type {
  DataRecord,
  DateOptions,
  DataOptions,
  ScaleOptions,
  DomainOptions,
  SubDomain
} from '@/composables/types/heatmap'
import type { Analytics } from '@/composables/types/analytics'
import CalHeatmap from 'cal-heatmap'
import Tooltip from 'cal-heatmap/plugins/Tooltip'
import type { CalHeatmapOptions, TooltipOptions } from 'cal-heatmap'

interface Props {
  readonly analyticsData: Analytics[]
}
const props = defineProps<Props>()

const visibleMonths = ref<number>(12)
const heatmapData = props.analyticsData.map((item) => ({ date: item.date, value: item.count }))
const cal: CalHeatmap = new CalHeatmap()

function paintCalendar() {
  const dateOptions: DateOptions = {
    start: new Date('2024-01-01'),
    locale: 'ja',
    timezone: 'Asia/Tokyo'
  }

  const dataOptions: DataOptions = {
    source: heatmapData,
    type: 'json',
    x: 'date',
    y: (d: DataRecord) => +d['value'],
    defaultValue: null
  }

  const scaleOptions: ScaleOptions = {
    color: {
      type: 'threshold',
      range: ['#e6e6e6', '#4dd05a'],
      domain: [1]
    }
  }

  const domainOptions: DomainOptions = {
    type: 'month',
    gutter: 4,
    label: {
      text: 'M月',
      position: 'top',
      textAlign: 'start',
      offset: {
        x: 0,
        y: 0
      },
      rotate: null,
      width: 100
    },
    sort: 'asc'
  }

  const subDomain: SubDomain = {
    type: 'ghDay',
    gutter: 4,
    width: 11,
    height: 11,
    radius: 2,
    label: null
  }

  const options: CalHeatmapOptions = {
    date: dateOptions,
    data: dataOptions,
    range: visibleMonths.value,
    scale: scaleOptions,
    domain: domainOptions,
    subDomain,
    itemSelector: '#heatmap'
  }

  const TOOLTIP_OPTIONS: TooltipOptions = {
    enabled: true,
    text: (timestanp: number, value: number | null, dayjsDate: dayjs.Dayjs) => {
      return `${value ?? 0} 件の投稿 ${dayjsDate.format('YYYY/MM/DD')}`
    }
  }

  cal.paint(options, [[Tooltip, TOOLTIP_OPTIONS]])
}
onMounted(() => paintCalendar())
</script>
<template>
  <div
    class="relative"
    :style="{
      color: '#adbac7',
      borderRadius: '3px',
      overflowX: 'auto'
    }"
  >
    <div id="heatmap"></div>
    <div class="sticky left-0 bottom-0 my-3 flex items-center gap-2">
      <a
        class="flex items-center justify-center w-20 h-6 duration-300 bg-gray-100 hover:bg-gray-200 text-sumi-700 text-mini font-body rounded-lg"
        href="#"
        @click.prevent="cal.previous()"
      >
        ← Previous
      </a>
      <a
        class="flex items-center justify-center w-20 h-6 duration-300 bg-gray-100 hover:bg-gray-200 text-sumi-700 text-mini font-body rounded-lg"
        href="#"
        @click.prevent="cal.next()"
      >
        Next →
      </a>
    </div>
  </div>
</template>
