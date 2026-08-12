import { PageProps as InertiaPageProps } from "@inertiajs/core";
import { CategoryResponseData } from "../generated/generated";

export interface Auth {
  user: User;
}

export type AppPageProps<
  T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
  name: string;
  quote: { message: string; author: string };
  auth: Auth;
};

export interface User {
  id: number;
  name: string;
  email: string;
  avatar?: string;
  email_verified_at: string | null;
  created_at: string;
  updated_at: string;
}
// 2. 自作の共有 Props 型（Inertia の基底 PageProps を継承・合成する）
export type PageProps<
  T extends Record<string, unknown> = Record<string, unknown>,
> = T &
  InertiaPageProps & {
    auth: {
      user: User | null;
    };
    categories: Array<CategoryResponseData>;
    flash: {
      message?: string;
      success?: string;
      error?: string;
    };
  };

// 3. Inertia 内部の PageProps インターフェースを拡張（Augmentation）
declare module "@inertiajs/core" {
  interface PageProps {
    auth: {
      user: User | null;
    };
    categories: Array<CategoryResponseData>;
    flash: {
      message?: string;
      success?: string;
      error?: string;
    };
  }
}
