export type DataRecord = Record<string, string | number>

export type DataGroupType = 'sum' | 'count' | 'min' | 'max' | 'average'

export type DateOptions = {
  start: Date
  min?: Date
  max?: Date
  highlight?: Date[]
  locale: string | Partial<ILocale>
  timezone?: string
}

export type DataOptions = {
  source: string | DataRecord[]
  type: 'json' | 'csv' | 'tsv' | 'txt'
  requestInit?: object
  x: string | ((datum: DataRecord) => number)
  y: string | ((datum: DataRecord) => number)
  groupY?: DataGroupType | ((values: (number | string | null)[]) => number | string | null)
  defaultValue: null | number | string
}

export type ScaleOptions = {
  opacity?: {
    baseColor: string
    domain: number[]
    type: string
  }
  color?: {
    scheme?: string
    range: string[]
    interpolate?: string
    domain: number[]
    type: string
  }
}

export type LabelOptions = {
  text?: string | null | ((timestamp: number, element: SVGElement) => string)
  position: 'top' | 'right' | 'bottom' | 'left'
  textAlign: 'start' | 'middle' | 'end'
  offset: {
    x: number
    y: number
  }
  rotate: null | 'left' | 'right'
  width: number
  height?: number
}

export type DomainOptions = {
  type: string
  gutter: number
  padding?: [number, number, number, number]
  dynamicDimension?: boolean
  label: LabelOptions
  sort: 'asc' | 'desc'
}

export type SubDomain = {
  type: string
  gutter: number
  width: number
  height: number
  radius: number
  label: string | null | ((timestamp: number, value: number, element: SVGElement) => string)
  color?: string | ((timestamp: number, value: number, backgroundColor: string) => string)
}
