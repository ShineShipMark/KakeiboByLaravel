declare namespace App {
  export type Paginated<T> = {
    data: T[];
    links: LinksParam[];
    meta: MetaParam;
  };
}

type LinksParam = {
  url: string | null;
  label: string;
  page: number | null;
  active: boolean;
};

type MetaParam = {
  currentPage: number;
  lastPage: number;
  perPage: number;
  total: number;
};
