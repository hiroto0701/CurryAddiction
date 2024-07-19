<script setup lang="ts">
import { onMounted } from 'vue'
import CalHeatmap from 'cal-heatmap'
import Tooltip from 'cal-heatmap/plugins/Tooltip'
import CalendarLabel from 'cal-heatmap/plugins/CalendarLabel'
import dayjs from 'dayjs'

const cal: CalHeatmap = new CalHeatmap()

function paintCalendar() {
  cal.paint(
    {
      data: {},
      date: {
        start: new Date('2024-01-01'),
        max: new Date('202-12-31'),
        timezone: 'Asia/Tokyo'
      },
      range: 12,
      scale: {
        color: {
          type: 'threshold',
          range: ['#e6e6e6', '#4dd05a'],
          domain: [10]
        }
      },
      domain: {
        type: 'month',
        gutter: 4,
        label: { text: 'M月', textAlign: 'start', position: 'top' }
      },
      subDomain: { type: 'ghDay', radius: 2, width: 11, height: 11, gutter: 4 },
      itemSelector: '#heatmap'
    },
    [
      [
        Tooltip,
        {
          text: function (date, value, dayjsDate) {
            return (value ? value : '0') + ' 件の投稿 ' + dayjsDate.format('YYYY/MM/DD')
          }
        }
      ]
    ]
  )
}

onMounted(() => paintCalendar())
</script>
<template>
  <div
    class="calendar-container"
    :style="{
      color: '#adbac7',
      borderRadius: '3px',
      padding: '1rem',
      overflowX: 'auto'
    }"
  >
    <div id="heatmap"></div>
  </div>
</template>
<style scoped></style>
