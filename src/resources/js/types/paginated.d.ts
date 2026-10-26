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
  current_page: number;
  last_page: number;
  total: number;
  from: number | null;
  to: number | null;
};
