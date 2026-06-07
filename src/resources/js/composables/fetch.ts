export const fetchAPIMethods = () => {
  const fetchs = async <T, U>(url: string, methods: string, data?: U) => {
    // 💡 GETでもPOSTでも共通して必要な「受け取る型」の指定だけにする
    const headers: Record<string, string> = {
      Accept: "application/json",
      "X-Requested-With": "XMLHttpRequest",
    };

    const options: RequestInit = {
      method: methods,
      mode: "cors",
      credentials: "omit",
      headers: headers,
    };

    if (methods === "GET") {
      // 💡 GETのときは「送るデータ」がないので、Content-Type は絶対に付けない！
    } else {
      // 💡 POSTやPUTなど、データを送るときだけ Content-Type と body を付ける
      headers["Content-Type"] = "application/json";

      const token =
        document
          .querySelector('meta[name="csrf-token"]')
          ?.getAttribute("content") || "";
      if (token) {
        headers["X-CSRF-TOKEN"] = token;
      }

      if (data !== undefined) {
        options.body = JSON.stringify(data);
      }
    }

    // 💡 URLは直接叩いて「55」が出た正確なURL（ポート番号付き）を指定してください
    const response = await fetch("/get_expense_purpose", options);

    if (!response.ok) {
      throw new Error("Network response was not ok");
    }
    return response.json() as T;
  };

  const searchData = async <T, Y>(
    url: string,
    method: string,
    param: Y,
  ): Promise<T> => {
    const { fetchs } = fetchAPIMethods();
    try {
      const result = await fetchs<T, Y>(url, `${method}`, param);
      return result;
    } catch (error) {
      throw error;
    }
  };
  return { fetchs, searchData };
};
